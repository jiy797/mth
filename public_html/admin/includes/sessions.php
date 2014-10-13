<?php


class session
{
    /* Define the mysql table you wish to use with
       this class, this table MUST exist. */
    var $ses_table = "yp_sessions_admin";

    /* Change to 'Y' if you want to connect to a db in
       the _open function */
    var $db_con = "Y";

	
		var $db_host = "";
		var $db_user = "";
		var $db_pass = "";
		var $db_dbase= "";
		var $life_time= "";
	
    /* Create a connection to a database */
    function db_connect() {
        $mysql_connect = @mysql_pconnect ($this->db_host,
                                          $this->db_user,
                                          $this->db_pass);
        $mysql_db = @mysql_select_db ($this->db_dbase);

        if (!$mysql_connect || !$mysql_db) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /* Open session, if you have your own db connection
       code, put it in here! */
    function _open($path, $name) {
        if ($this->db_con == "Y") {
            $this->db_connect();
        }

        return TRUE;
    }

    /* Close session */
    function _close() {
        /* This is used for a manual call of the
           session gc function */
        $this->_gc(0);
        return TRUE;
    }

    /* Read session data from database */
    function _read($ses_id) {
        $session_sql = "SELECT * FROM " . $this->ses_table
                     . " WHERE ses_id = '$ses_id'";
        $session_res = @mysql_query($session_sql);
        if (!$session_res) {
            return '';
        }

        $session_num = @mysql_num_rows ($session_res);
        if ($session_num > 0) {
            $session_row = mysql_fetch_assoc ($session_res);
            $ses_data = $session_row["ses_value"];
            return $ses_data;
        } else {
            return '';
        }
    }

    /* Write new data to database */
    function _write($ses_id, $data) {
        $session_sql = "UPDATE " . $this->ses_table
                     . " SET ses_time='" . time()
                     . "', ses_value='$data' WHERE ses_id='$ses_id'";
        $session_res = @mysql_query ($session_sql);
        if (!$session_res) {
            return FALSE;
        }
        if (mysql_affected_rows ()) {
            return TRUE;
        }

        $session_sql = "INSERT INTO " . $this->ses_table
                     . " (ses_id, ses_time, ses_start, ses_value)"
                     . " VALUES ('$ses_id', '" . time()
                     . "', '" . time() . "', '$data')";
        $session_res = @mysql_query ($session_sql);
        if (!$session_res) {    
            return FALSE;
        }         else {
            return TRUE;
        }
    }

    /* Destroy session record in database */
    function _destroy($ses_id) {
        $session_sql = "DELETE FROM " . $this->ses_table
                     . " WHERE ses_id = '$ses_id'";
        $session_res = @mysql_query ($session_sql);
        if (!$session_res) {
            return FALSE;
        }         else {
            return TRUE;
        }
    }

    /* Garbage collection, deletes old sessions */
    function _gc($life) {
        $ses_life = strtotime("-5 minutes");

        $session_sql = "DELETE FROM " . $this->ses_table
                     . " WHERE ses_time < $ses_life";
        $session_res = @mysql_query ($session_sql);


        if (!$session_res) {
            return FALSE;
        }         else {
            return TRUE;
        }
    }
}
?>
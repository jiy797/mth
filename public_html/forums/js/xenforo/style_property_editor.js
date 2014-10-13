/**
 * @author kier
 */

/** @param {jQuery} $ jQuery Object */
!function($, window, document, _undefined)
{
	/**
	 *
	 * @param $jQuery .StylePropertyEditor
	 */
	XenForo.StylePropertyEditor = function($unit) { this.__construct($unit); };
	XenForo.StylePropertyEditor.prototype =
	{
		__construct: function($unit)
		{
			this.$unit = $unit;

			this.initTextDecoration();
		},

		initTextDecoration: function()
		{
			this.$textDecorationCheckBoxes = $('.TextDecoration input:checkbox', this.$unit);

			this.$textDecorationCheckBoxes.click($.context(this, 'handleTextDecorationClick'));
		},

		handleTextDecorationClick: function(e)
		{
			var $target = $(e.target);

			console.log('Text-decoration checkbox - Value=%s, Checked=%s', $target.attr('value'), $target.is(':checked'));

			if (!$target.is(':checkbox'))
			{
				$target.attr('checked', !$target.is(':checked'));
			}

			if ($target.is(':checked'))
			{
				if ($target.attr('value') == 'none')
				{
					// uncheck all the other checkboxes
					this.$textDecorationCheckBoxes.not('[value="none"]').attr('checked', false);
				}
				else
				{
					// uncheck the 'none' checkbox
					this.$textDecorationCheckBoxes.filter('[value="none"]').attr('checked', false);
				}
			}
		}
	};

	// *********************************************************************

	XenForo.StylePropertyTooltip = function($item)
	{
		var $descriptionTip = $item.find('div.DescriptionTip')
			.addClass('xenTooltip propertyDescriptionTip')
			.appendTo('body')
			.append('<span class="arrow" />');

		if ($descriptionTip.length)
		{
			$item.tooltip(
			{
				/*effect: 'fade',
				fadeInSpeed: XenForo.speed.normal,
				fadeOutSpeed: 0,*/

				position: 'bottom left',
				offset: [ -24, -3 ],
				tip: $descriptionTip,
				delay: 0
			});
		}
	};

	// *********************************************************************

	XenForo.register('.StylePropertyEditor', 'XenForo.StylePropertyEditor');

	XenForo.register('#propertyTabs > li', 'XenForo.StylePropertyTooltip');
}
(jQuery, this, document);
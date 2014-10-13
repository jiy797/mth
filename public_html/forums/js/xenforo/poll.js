/** @param {jQuery} $ jQuery Object */
!function($, window, document, _undefined)
{
	XenForo.PollAddResponseButton = function($element) { this.__construct($element); };
	XenForo.PollAddResponseButton.prototype =
	{
		__construct: function($element)
		{
			if (!$element.data('source'))
			{
				return;
			}

			var $source = $($element.data('source'));
			if (!$source.length)
			{
				$element.hide();
				return;
			}

			this.$el = $element;
			this.$source = $source.clone();
			this.$container = $($element.data('container'));
			this.maximum = $element.data('maximum');

			$element.click($.context(this, 'click'));
			this.setElementVisibility();
		},

		click: function()
		{
			var $newEl = this.$source.clone(),
				$newElInput = $newEl.find('input');

			$newElInput.val('');
			$newEl.xfInsert('appendTo', this.$container, false, false, function()
			{
				$newElInput.select();
			});

			this.setElementVisibility();
		},

		setElementVisibility: function()
		{
			if (this.maximum)
			{
				if (this.$container.children().length >= this.maximum)
				{
					this.$el.hide();
				}
				else
				{
					this.$el.show();
				}
			}
		}
	};

	// *********************************************************************

	XenForo.register('.PollAddResponseButton', 'XenForo.PollAddResponseButton');

}
(jQuery, this, document);
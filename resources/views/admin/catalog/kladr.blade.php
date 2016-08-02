@section('assetsJS')
	<script type="text/javascript">
		$(function () {
			/*$.kladr.buildAddress = function(objs) {
				console.log(objs);
			};*/
			var valueFormat = $.kladr.valueFormat;
			$.kladr.valueFormat = function(obj, query) {
				// console.log($.kladr.prototype.valueFormat(label))
				console.log(valueFormat)
				/*var segments = label.split(', ');
				segments.pop();
				console.log(segments.join(', '))
				return segments.join(', ');*/
			};
			var $address = $('[name="address"]');

			$address.kladr({
				token: '5787efab0a69de955e8b45de',
				oneString: true,
				change: function (obj) {
					console.log(obj);
				}
			});
		});
	</script>
@stop
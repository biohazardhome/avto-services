@section('assetsJS')
	<script type="text/javascript">
		$(function () {
			var el = $('input[name="name"]');

			el.kladr({
				token: '5787efab0a69de955e8b45de',
				type: $.kladr.type.city,
				change: function (obj) {
					console.log(obj);
				}
			});
		});
	</script>
@stop
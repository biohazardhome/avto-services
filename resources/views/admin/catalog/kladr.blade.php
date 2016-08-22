<script type="text/javascript">
	$(function () {
		/*$.kladr.buildAddress = function(objs) {
			console.log(objs);
		};*/
		// var valueFormat = $.kladr.valueFormat;
		var $address = $('[name="address"]');

		$address.kladr({
			token: '5787efab0a69de955e8b45de',
			oneString: true,
			change: function (obj) {
				// console.log(obj);
			},
			valueFormat: function(obj, query) {
				var objs;

				if (query.oneString) {
					if (obj.parents) {
						objs = [].concat(obj.parents);
						objs.push(obj);

						var labels = objs.filter(function(item) {
							console.log(item);
							return !['cityOwner'].includes(item.contentType);
						}).map(function(item) {
							// if (item.contentType) {
								var name = item.name
									type = item.type.toLowerCase(),
									contentType = item.contentType;

								return (['region', 'district', 'city', 'street', 'building'].includes(contentType)) ? 
										['region', 'district'].includes(contentType) ? name +' '+ type : type +' '+ name 
									: name;
							// }
						});
						return labels.join(', ');
					}

					return (obj.typeShort ? obj.typeShort + '. ' : '') + obj.name;
				}

				return obj.name;
			}
		});
	});
</script>
/**
 * @author Kishor Mali
 */

jQuery(document).ready(function () {
	jQuery(document).on('click', '.deleteUser', function () {
		var userId = $(this).data('delid'),
			hitURL = baseURL + 'deleteUser',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('link', link)
		// console.log('value', value)
		// console.log('isNotNum', _isNotNum)

		if (_isNotNum) {
			var reDirect = baseURL + 'user/userListing'
		} else {
			var reDirect = baseURL + 'user/userListing/' + value
		}

		var confirmation = confirm('確認刪除此人員 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						userId: userId,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
					// if (data.status = true) {
					// 	alert("人員成功刪除");
					// } else if (data.status = false) {
					// 	alert("用戶刪除失敗!");
					// } else {
					// 	alert("拒絕訪問..!");
					// }
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.newsListDel', function () {
		var pr_id = $(this).data('delid'),
			type_id = $(this).data('typeid'),
			img = $(this).data('img'),
			hitURL = baseURL + 'news/newsListDel',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('pr_id', pr_id)
		// console.log('type_id', type_id)
		// console.log('link', link)
		// console.log('hitURL', hitURL)
		// console.log('value', value)
		// console.log('isNotNum', _isNotNum)

		var reDirect = baseURL;

		// 若url最後不爲數字
		if (_isNotNum) {
			reDirect += 'news/lists/' + type_id
		} else {
			reDirect += 'news/lists/' + type_id + '/' + value;
		}

		switch (type_id) {
			case 1:
				var confirmation = confirm('確認刪除此法案及議事 ?')
				break
			case 2:
				var confirmation = confirm('確認刪除此懶人包及議題 ?')
				break
			case 3:
				var confirmation = confirm('確認刪除此行動紀實 ?')
				break

			default:
				break
		}

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						pr_id: pr_id,
						type_id: type_id,
						img: img,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deleteNewsTag', function () {
		var tagid = $(this).data('tagsid'),
			hitURL = baseURL + 'news/deleteNewsTag',
			currentRow = $(this),
			reDirect = baseURL,
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('tagsid', tagid);
		// console.log('link', link);
		// console.log('value', value);
		// console.log('isNotNum', _isNotNum);

		if (_isNotNum) {
			reDirect += 'news/tagLists'
		} else {
			reDirect += 'news/tagLists/' + value
		}

		var confirmation = confirm('確認刪除此標籤 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						tags_id: tagid,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deleteCarousel', function () {
		var carouselid = $(this).data('carouselid'),
			img = $(this).data('img'),
			hitURL = baseURL + 'website/deleteCarousel',
			currentRow = $(this),
			reDirect = baseURL,
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('tagsid', tagid);
		// console.log('link', link);
		// console.log('value', value);
		// console.log('isNotNum', _isNotNum);

		if (_isNotNum) {
			reDirect += 'website/carouselLists'
		} else {
			reDirect += 'website/carouselLists/' + value
		}

		var confirmation = confirm('確認刪除此輪播項目 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						id: carouselid,
						img: img,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deleteManager', function () {
		var userId = $(this).data('userid'),
			hitURL = baseURL + 'user/deleteManager',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('link', link)
		// console.log('value', value)
		// console.log('isNotNum', _isNotNum)

		if (_isNotNum) {
			var reDirect = baseURL + 'user/userListing'
		} else {
			var reDirect = baseURL + 'user/userListing/' + value
		}

		var confirmation = confirm('確認刪除此人員 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						userId: userId,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deleteLegislator', function () {
		var yearId = $(this).data('yearid'),
			legId = $(this).data('legid'),
			yearTitle = $(this).data('title'),
			hitURL = baseURL + 'legislator/deleteLegislator',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			_lastValue = link.substring(link.lastIndexOf('/') + 1),
			ary = link.split('/'),
			arySplit = ary[ary.length - 1].split('#')

		// for (let i = ary1.length - 1; i > 3; i--) {
		// 	console.log(ary1[i].split('#'));
		// }
		// ary1.forEach(e => {
		// 	console.log(e);
		// });

		// var url = link.substr(link.lastIndexOf('/', link.lastIndexOf('/') - 1) + 1);
		// var url2 = link.substring(link.lastIndexOf('/', link.lastIndexOf('/', link.lastIndexOf('/') - 1) - 1) + 1, link.lastIndexOf('/', link.lastIndexOf('/') - 1));//獲取網址列最後三個值
		// var site = url.lastIndexOf("\/"); //获取最后一个/的位置
		// var _last2Value = url.substring(0, site); //截取最后一个/前的值

		// console.log('_lastValue', _lastValue)
		// console.log('length', ary.length)
		// console.log('ary1Last', arySplit[0])

		if (ary.length === 8 && _lastValue != '#') {
			//本機端爲8,伺服端爲7
			var reDirect =
				baseURL + 'legislator/legislatorListPage/' + yearId + '/' + arySplit[0]
		} else {
			var reDirect = baseURL + 'legislator/legislatorListPage/' + yearId
		}

		var confirmation = confirm('確認刪除此委員資料和大頭照 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						yearid: yearId,
						legid: legId,
						title: yearTitle,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deleteLegislatorYear', function () {
		var userId = $(this).data('yearid'),
			yearTitle = $(this).data('title'),
			hitURL = baseURL + 'legislator/deleteLegislatorYear',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('link', link)
		// console.log('value', value)
		// console.log('isNotNum', _isNotNum)

		if (_isNotNum) {
			var reDirect = baseURL + 'legislator'
		} else {
			var reDirect = baseURL + 'legislator/' + value
		}

		var confirmation = confirm('確認刪除此屆期及其相關委員資料和大頭照 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						yearid: userId,
						title: yearTitle,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.deletePartyMember', function () {
		var memid = $(this).data('memid'),
			hitURL = baseURL + 'partymember/deletePartyMember',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(
				link.lastIndexOf('/') + 1,
				link.lastIndexOf('/') + 3,
			),
			_isNotNum = isNaN(value)

		// console.log('link', link)
		// console.log('value', value)
		// console.log('isNotNum', _isNotNum)

		if (_isNotNum) {
			var reDirect = baseURL + 'partymember'
		} else {
			var reDirect = baseURL + 'partymember/index/' + value
		}

		var confirmation = confirm('確認刪除此黨員 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						memid: memid,
					},
				})
				.done(function (data) {
					// console.log(data)
					currentRow.parents('tr').remove()
				})

			window.location.href = reDirect
		}
	})

	jQuery(document).on('click', '.searchList', function () {})
})
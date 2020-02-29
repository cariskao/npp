/**
 * @author Kishor Mali
 */

jQuery(document).ready(function () {
	jQuery(document).on('click', '.deleteUser', function () {
		var userId = $(this).data('delid'),
			hitURL = baseURL + 'deleteUser',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(link.lastIndexOf('/') + 1, link.lastIndexOf('/') + 3),
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
					window.location.href = reDirect
				})
		}
	})

	jQuery(document).on('click', '.newsListDel', function () {
		var pr_id = $(this).data('delid'),
			type_id = $(this).data('typeid'),
			img = $(this).data('img'),
			hitURL = baseURL + 'news/newsListDel',
			currentRow = $(this),
			link = window.location.href,
			reDirect = link

		// console.log('link', link);

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
					if (data.status) {
						alert("成功刪除");

						currentRow.parents('tr').remove()
						window.location.href = reDirect
					} else if (!data.status) {
						alert("刪除失敗!");
					} else {
						alert("拒絕訪問..!");
					}
				})
		}
	})

	jQuery(document).on('click', '.deleteNewsTag', function () {
		var tagid = $(this).data('tagsid'),
			hitURL = baseURL + 'news/deleteNewsTag',
			currentRow = $(this),
			link = window.location.href,
			reDirect = link

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
					if (data.status) {
						alert("成功刪除");

						currentRow.parents('tr').remove()
						window.location.href = reDirect
					} else if (!data.status) {
						alert("刪除失敗!");
					} else {
						alert("拒絕訪問..!");
					}
				})
		}
	})

	jQuery(document).on('click', '.deleteCarousel', function () {
		var carouselid = $(this).data('carouselid'),
			img = $(this).data('img'),
			lastone = $(this).data('lastone'),
			count = $(this).data('count'),
			hitURL = baseURL + 'website/deleteCarousel',
			currentRow = $(this),
			link = window.location.href



		// if (carouselid == lastone) {
		// 	reDirect = link.substring(0, link.lastIndexOf('/'));
		// } else {
		// 	reDirect = link;
		// }

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
					if (data.status) {
						alert("成功刪除");

						currentRow.parents('tr').remove()
						window.location.href = reDirect
					} else if (!data.status) {
						alert("刪除失敗!");
					} else {
						alert("拒絕訪問..!");
					}
				})
		}
	})

	jQuery(document).on('click', '.deleteManager', function () {
		var userId = $(this).data('userid'),
			hitURL = baseURL + 'user/deleteManager',
			currentRow = $(this),
			link = jQuery(this).get(0).href,
			value = link.substring(link.lastIndexOf('/') + 1, link.lastIndexOf('/') + 3),
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
					window.location.href = reDirect
				})
		}
	})

	jQuery(document).on('click', '.deleteYears', function () {
		var yid = $(this).data('yid'),
			hitURL = baseURL + 'members/deleteYears',
			currentRow = $(this),
			link = window.location.href,
			reDirect = link

		var confirmation = confirm('確認刪除此屆期 ?')

		if (confirmation) {
			jQuery
				.ajax({
					type: 'POST',
					dataType: 'json',
					url: hitURL,
					data: {
						yid: yid,
					},
				})
				.done(function (data) {
					if (data.status) {
						alert("成功刪除");

						currentRow.parents('tr').remove()
						window.location.href = reDirect
					} else if (!data.status) {
						alert("刪除失敗!");
					} else {
						alert("拒絕訪問..!");
					}
				})
		}
	})

	// var link = window.location.href,
	// 	_lastValue = link.substring(link.lastIndexOf('/') + 1),
	// 	ary = link.split('/'),
	// 	arySplit = ary[ary.length - 1].split('#')
	// jQuery(document).on('click', '.searchList', function () {})
})
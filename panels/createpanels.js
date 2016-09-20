function createpanel(contentobject, index, container) {
	var viewurl = "/view.php?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
	var contentcontainer = document.getElementById(container);
	var contentdiv = document.createElement("div");
	contentdiv.className = "col-lg-4 col-md-4 col-xs-12 thumbnail-item white-background"

	var thumbnail = document.createElement("a");
	thumbnail.className = "thumbnail";
	thumbnail.href = viewurl;
	thumbnail.innerHTML = "<img crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var thumbnaildetail = document.createElement("div");
	thumbnaildetail.className = "thumbnail-detail";
	thumbnaildetail.innerHTML = "<span>360° VR</span><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";

	var thumbnailtitle = document.createElement("div");
	thumbnailtitle.className = "thumbnail-title";
	thumbnailtitle.innerHTML = "<a href=" + viewurl + ">" + contentobject.contentobjecttitle + "</a>";

	var thumbnailcounts = document.createElement("div");
	thumbnailcounts.className = "thumbnail-counts";

	var thumbnailby = document.createElement("div");
	thumbnailby.className = "col-xs-8 col-md-8";
	thumbnailby.innerHTML = "<a href=/profile/profile.php?user="+ contentobject.contentobjectuser +">" + contentobject.contentobjectuser + "</a>";

	var thumbnailviews = document.createElement("div");
	thumbnailviews.className = "col-xs-4 col-md-4 views";
	thumbnailviews.innerHTML = "<a>"+ contentobject.contentobjectviews + " views</a>";

	contentcontainer.appendChild(contentdiv);
	contentdiv.appendChild(thumbnail);
	//contentdiv.appendChild(thumbnaildetail);
	contentdiv.appendChild(thumbnailtitle);
	contentdiv.appendChild(thumbnailcounts);
	thumbnailcounts.appendChild(thumbnailby);
	thumbnailcounts.appendChild(thumbnailviews);
}

function createcarouselpanel(contentobject, index, container, playlistid) {
	var viewurl = "/view.php?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser + "&p=" + playlistid;
	var carouselcontainer = document.getElementById(container);
	var contentdiv = document.createElement("div");
	contentdiv.className = "thumbnail-item span4 carousel-block"

	var thumbnail = document.createElement("a");
	thumbnail.className = "thumbnail";
	thumbnail.href = viewurl;
	thumbnail.innerHTML = "<img crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var thumbdiv = document.createElement("div");

	var thumbnailtitle = document.createElement("div");
	thumbnailtitle.className = "thumbnail-title";
	thumbnailtitle.innerHTML = "<a href=" + viewurl + ">" + contentobject.contentobjecttitle + "</a>";

	carouselcontainer.appendChild(contentdiv);
	contentdiv.appendChild(thumbnail);
	contentdiv.appendChild(thumbdiv);
	thumbdiv.appendChild(thumbnailtitle);
}

function createrecommendedpanel(contentobject, index, container) {
	var viewurl = "/view.php?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
	var contentcontainer = document.getElementById(container);
	var contentdiv = document.createElement("div");
	contentdiv.className = "col-lg-12 col-md-12 col-xs-12 thumbnail-item white-background"

	var thumbnail = document.createElement("a");
	thumbnail.className = "thumbnail";
	thumbnail.href = viewurl;
	thumbnail.innerHTML = "<img crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var thumbnaildetail = document.createElement("div");
	thumbnaildetail.className = "thumbnail-detail";
	thumbnaildetail.innerHTML = "<span>360° VR</span><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";

	var thumbnailtitle = document.createElement("div");
	thumbnailtitle.className = "thumbnail-title";
	thumbnailtitle.innerHTML = "<a href=" + viewurl + ">" + contentobject.contentobjecttitle + "</a>";

	var thumbnailcounts = document.createElement("div");
	thumbnailcounts.className = "thumbnail-counts";

	var thumbnailby = document.createElement("div");
	thumbnailby.className = "col-xs-8 col-md-8";
	thumbnailby.innerHTML = "<a href=/profile/profile.php?user="+ contentobject.contentobjectuser +">" + contentobject.contentobjectuser + "</a>";

	var thumbnailviews = document.createElement("div");
	thumbnailviews.className = "col-xs-4 col-md-4 views";
	thumbnailviews.innerHTML = "<a>"+ contentobject.contentobjectviews + " views</a>";

	contentcontainer.appendChild(contentdiv);
	contentdiv.appendChild(thumbnail);
	//contentdiv.appendChild(thumbnaildetail);
	contentdiv.appendChild(thumbnailtitle);
	contentdiv.appendChild(thumbnailcounts);
	thumbnailcounts.appendChild(thumbnailby);
	thumbnailcounts.appendChild(thumbnailviews);
}
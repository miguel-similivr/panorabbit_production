function createprofilepanel(contentobject, index, container) {
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
	contentdiv.appendChild(thumbnaildetail);
	contentdiv.appendChild(thumbnailtitle);
	contentdiv.appendChild(thumbnailcounts);
	thumbnailcounts.appendChild(thumbnailby);
	thumbnailcounts.appendChild(thumbnailviews);
}
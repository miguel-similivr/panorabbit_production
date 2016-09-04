function creategallerypanel(contentobject, index) {
	var viewurl = "view.php?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
	var contentcontainer = document.getElementById("contentcontainer");
	var contentdiv = document.createElement("div");
	contentdiv.className = "col-lg-4 col-md-4 col-xs-12 thumbnail-item"

	var thumbnail = document.createElement("a");
	thumbnail.className = "thumbnail";
	thumbnail.href = viewurl;
	thumbnail.innerHTML = "<img crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var thumbnaildetail = document.createElement("div");
	thumbnaildetail.className = "thumbnail-detail";

	var thumbnailtitle = document.createElement("div");
	thumbnailtitle.className = "thumbnail-title";
	thumbnailtitle.innerHTML = "<a>" + contentobject.contentobjecttitle + "</a>";

	var thumbnailcounts = document.createElement("div");
	thumbnailcounts.className = "thumbnail-counts";

	var thumbnailby = document.createElement("div");
	thumbnailby.className = "col-xs-8 col-md-8";
	thumbnailby.innerHTML = "<a>" + contentobject.contentobjectdescription + "</a>";

	var thumbnailviews = document.createElement("div");
	thumbnailviews.className = "col-xs-4 col-md-4";
	thumbnailviews.innerHTML = "<a>"+ contentobject.contentobjectviews + " views</a>";

	contentcontainer.appendChild(contentdiv);
	contentdiv.appendChild(thumbnail);
	thumbnail.appendChild(thumbnaildetail);
	thumbnaildetail.appendChild(thumbnailtitle);
	thumbnaildetail.appendChild(thumbnailcounts);
	thumbnailcounts.appendChild(thumbnailby);
	thumbnailcounts.appendChild(thumbnailviews);
}
function createcontentpanel(contentobject, index, container) {
	var playerurl = "http://panorabbit.com/player.html?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
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

	var thumbnaildash = document.createElement("div");
	thumbnaildash.className = "thumbnail-dash";
	thumbnaildash.innerHTML = "<a href='#' class='btn btn-primary dropdown-toggle dash-dropdown' role='button' data-toggle='dropdown' >edit<span class='caret'></a>";

	var thumbnaildropdown = document.createElement("ul");
	thumbnaildropdown.className = "dropdown-menu";

	var share = document.createElement("li");
	share.innerHTML = "<a href='https://www.facebook.com/sharer.php?u=http://panorabbit.com" + viewurl +"'>Share</a>";

	var embed = document.createElement("li");
	var embedcode = "<iframe src=\\042" + playerurl + "\\042 height=\\042200\\042 width=\\042300\\042 style=\\042border:none\\042 allowfullscreen></iframe>";
	var embedmodal  = document.createElement("a");
	embedmodal.href = "javascript:{}";
	embedmodal.setAttribute("onclick", "document.getElementById('embed-modal').value = '" + embedcode +"';");
	embedmodal.setAttribute("data-toggle", "modal");
	embedmodal.setAttribute("data-target", "#embed");
	embedmodal.innerHTML = "Embed";

	var deleteupload = document.createElement("li");

	var deleteform = document.createElement("form");
	deleteform.name = "deleteForm";
	deleteform.id = "delete-" + contentobject.contentobjectid;
	deleteform.method = "POST";
	deleteform.action = "delete_img.php";

	var deletebtn  = document.createElement("a");
	deletebtn.href = "javascript:{}";
	deletebtn.setAttribute("onclick", "document.getElementById('delete-" + contentobject.contentobjectid + "').submit();");
	deletebtn.innerHTML = "Delete";

	var deleteid  = document.createElement("input");
	deleteid.name = "deleteid";
	deleteid.id = "deleteid";
	deleteid.value = contentobject.contentobjectid;
	deleteid.type = "hidden";

	var deletefile  = document.createElement("input");
	deletefile.name = "deletefile";
	deletefile.id = "deletefile";
	deletefile.value = contentobject.contentobjecturl.split('/')[5];
	deletefile.type = "hidden";

	contentcontainer.appendChild(contentdiv);

	contentdiv.appendChild(thumbnail);
	contentdiv.appendChild(thumbnaildetail);
	contentdiv.appendChild(thumbnailtitle);
	contentdiv.appendChild(thumbnailcounts);

	thumbnailcounts.appendChild(thumbnaildash);
	thumbnaildash.appendChild(thumbnaildropdown);
	thumbnaildropdown.appendChild(share);
	thumbnaildropdown.appendChild(embed);
	thumbnaildropdown.appendChild(deleteupload);

	deleteupload.appendChild(deleteform);
	deleteform.appendChild(deletebtn);
	deleteform.appendChild(deleteid);
	deleteform.appendChild(deletefile);

	embed.appendChild(embedmodal);
}

function createcontentpanelx(contentobject, index) {
	var contentcontainer = document.getElementById("contentcontainer");
	var contentdiv = document.createElement("div");
	contentdiv.className = "card col-lg-12 col-xs-12"//"row panel panel-default";
	contentdiv.id = "content-"+index.toString();

	var thumbnail = document.createElement("div");
	thumbnail.className = "col-lg-12 col-xs-12 thumb card-img-top";
	thumbnail.innerHTML = "<img class='img-responsive' crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var contentbody = document.createElement("div");
	contentbody.className = "col-lg-12 col-xs-12 textcontent card-block";

	var url = document.createElement("p");
	url.innerHTML =  "Source: <a href=" + contentobject.contentobjecturl + ">" + contentobject.contentobjecturl +"</a>";

	var playerurl = "http://panorabbit.com/player.html?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
	var playerlink = document.createElement("p");
	playerlink.innerHTML = "Link to player (click for preview): <a href='" + playerurl + "'>" + playerurl + "</a>";

	var embed = document.createElement("p");
	embed.innerHTML = "Embed code: <br><code>&ltiframe src='" + playerurl + "' height=\"200\" width=\"300\" style=\"border:none;\" allowfullscreen&gt&lt/iframe&gt</code>";

	var deleteform = document.createElement("form");
	deleteform.name = "deleteForm";
	deleteform.method = "POST";
	deleteform.action = "delete_img.php";

	var deletebtn  = document.createElement("input");
	deletebtn.name = "deletebtn";
	deletebtn.className = "btn delete";
	deletebtn.value = "Delete";
	deletebtn.type = "submit";

	var deletefile  = document.createElement("input");
	deletefile.name = "deletefile";
	deletefile.id = "deletefile";
	deletefile.value = contentobject.contentobjecturl.split('/')[5];
	deletefile.type = "hidden";


	var deleteid  = document.createElement("input");
	deleteid.name = "deleteid";
	deleteid.id = "deleteid";
	deleteid.value = contentobject.contentobjectid;
	deleteid.type = "hidden";

	var previewbtn  = document.createElement("button");
	previewbtn.id = "previewbtn-"+index.toString();
	previewbtn.className = "btn preview";
	previewbtn.onclick = function(){createiframe(playerurl, contentdiv)};
	previewbtn.innerHTML = "Preview";

	var sharebtn  = document.createElement("button");
	sharebtn.id = "sharebtn-"+index.toString();
	sharebtn.className = "btn share";
	sharebtn.innerHTML = "Share";
	sharebtn.onclick = function(){createsharelinks(contentbody, playerlink, embed)};
	
	contentcontainer.appendChild(contentdiv);
	contentdiv.appendChild(thumbnail);
	contentdiv.appendChild(contentbody);
	//text.appendChild(url);
	contentbody.appendChild(deleteform);
	//contentbody.appendChild(previewbtn);
	//contentbody.appendChild(sharebtn);
	contentbody.appendChild(playerlink);
	contentbody.appendChild(embed);
	deleteform.appendChild(deletebtn);
	deleteform.appendChild(deletefile);
	deleteform.appendChild(deleteid);
	

	$("#"+previewbtn.id).on('touchstart', function(){
		createiframe(playerurl, contentdiv);
	});
}
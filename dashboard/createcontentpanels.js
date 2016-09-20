function deleteFunction(id) {
  if (confirm("Delete content?") == true) {
      document.getElementById(id).submit();
  }
}

function createcontentpanel(contentobject, index, container) {
	var playerurl = "http://panorabbit.com/player.html?id=" + contentobject.contentobjectid + "&user=" + contentobject.contentobjectuser;
	var viewurl = "/view.php?id=" + contentobject.contentobjectid + "%26user=" + contentobject.contentobjectuser;
	var contentcontainer = document.getElementById(container);
	var contentdiv = document.createElement("div");
	contentdiv.className = "col-lg-4 col-md-4 col-xs-12 thumbnail-item white-background";

	var thumbnail = document.createElement("a");
	thumbnail.className = "thumbnail";
	thumbnail.href = viewurl;
	thumbnail.innerHTML = "<img crossorigin='anonymous' src='" + contentobject.contentobjecturl + "'/>";

	var thumbnailtitle = document.createElement("div");
	thumbnailtitle.className = "thumbnail-title";
	thumbnailtitle.innerHTML = "<a href=" + viewurl + ">" + contentobject.contentobjecttitle + "</a>";

	var thumbnaildash = document.createElement("div");
	thumbnaildash.className = "thumbnail-dash";

	var share = document.createElement("div");
	share.className = "col-md-4 col-xs-4";
	share.innerHTML = "<a class='btn-xs btn-block btn-social btn-facebook fb-share' href='https://www.facebook.com/sharer.php?u=http://panorabbit.com" + viewurl +"'><span class='fa fa-facebook'></span>Share</a>";

	var embed = document.createElement("div");
	var embedcode = "<iframe src=\\042" + playerurl + "\\042 height=\\042200\\042 width=\\042300\\042 style=\\042border:none\\042 allowfullscreen></iframe>";
	var embedmodal  = document.createElement("a");
	embed.className = "col-md-4 col-xs-4";
	embedmodal.className = "btn-xs btn-block btn-social embed";
	embedmodal.href = "javascript:{}";
	embedmodal.setAttribute("onclick", "document.getElementById('embed-modal').value = '" + embedcode +"';");
	embedmodal.setAttribute("data-toggle", "modal");
	embedmodal.setAttribute("data-target", "#embed");
	embedmodal.innerHTML = "<span class='fa fa-code'></span>Embed";

	var deleteupload = document.createElement("div");
	deleteupload.className = "col-md-4 col-xs-4";

	var deleteform = document.createElement("form");
	deleteform.name = "deleteForm";
	deleteform.id = "delete-" + contentobject.contentobjectid;
	deleteform.method = "POST";
	deleteform.action = "delete_img.php";

	var deletebtn  = document.createElement("a");
	deletebtn.className = "btn-xs btn-block btn-social delete-img";
	deletebtn.href = "javascript:{}";
	deletebtn.setAttribute("onclick", "deleteFunction('delete-" + contentobject.contentobjectid + "')");
	deletebtn.innerHTML = "<span class='fa fa-trash-o'></span>Delete";

	var deleteid  = document.createElement("input");
	deleteid.name = "deleteid";
	deleteid.id = "deleteid";
	deleteid.value = contentobject.contentobjectid;
	deleteid.type = "hidden";

	var deletefile  = document.createElement("input");
	deletefile.name = "deletefile";
	deletefile.id = "deletefile";
	deletefile.value = contentobject.contentobjecturl.split('/')[6];
	deletefile.type = "hidden";

	contentcontainer.appendChild(contentdiv);

	contentdiv.appendChild(thumbnail);
	contentdiv.appendChild(thumbnailtitle);
	contentdiv.appendChild(thumbnaildash);

	thumbnaildash.appendChild(share);
	thumbnaildash.appendChild(embed);
	thumbnaildash.appendChild(deleteupload);

	deleteupload.appendChild(deletebtn);
	deleteupload.appendChild(deleteform);
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
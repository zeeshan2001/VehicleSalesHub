window.addEventListener("load", function () {
		Array.prototype.slice.call(document.querySelectorAll("input[id*='_image_']")).forEach(function (e) {
				! function (e) {
						var n = e.split("_")[1];
						document.getElementById(e).addEventListener("change", function (e) {
								if (e.target.files[0]) {
										 var t = document.getElementById("image_" + n),
										  var t = document.querySelector('[id$="_image_" + n]').id;
												i = document.getElementById("error_" + n),
												a = document.getElementById("preview_" + n);
										i.innerText = "";
										var l = e.target.files[0],
												o = l.name,
												r = o.split(".")[o.split(".").length - 1].toLowerCase(),
												d = (l.size / 1048576).toFixed(2),
												s = "";
										if ("jpg" !== r && "jpeg" !== r && "png" !== r && (s = "Your File type : " + r + "\n", s += "Please make sure your file is in image format with extension jpg, jpeg or png.\n"), d > 10 && (s += "\nYour File Size: " + d + " MB \n", s += "Please make sure your image is less than 10 MB"), "" != s) return i.innerText = s, t.value = "", a.innerHTML = "", void(a.style.display = "none");
										loadImage(l, function (e) {
												a.innerHTML = "", a.appendChild(e);
												var n = document.createElement("button");
												n.type = "button", n.innerText = "x", n.className = "closeBtn", n.addEventListener("click", function (e) {
														a.innerHTML = "", t.value = "", a.style.display = "none"
												}), a.appendChild(n), a.style.display = "block"
										}, {
												maxWidth: 200,
												orientation: !0
										})
								}
						}, !1)
				}(e.id)
		})
});

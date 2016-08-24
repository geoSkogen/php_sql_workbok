window.onload = initLinks;

function initLinks() {
  var as = document.getElementsByTagName("a");
  var butts = document.getElementsByClassName("button");
  var links = document.getElementsByClassName("linkage");
  var total = butts.length + links.length;
  var linkIndex = 0;

  for (var i = butts.length; i < total; i++) {
    butts[i] = links[linkIndex];
    linkIndex++;
  }

  getHref(butts, as);

  function getHref(clickage, linkage) {
    var href;
    for (var i = 0; i < linkage.length; i++ ) {
      href = linkage[i].getAttribute("href");
      clickLink(clickage[i], href);
    }
  }

  function clickLink(elm, url) {
    elm.onclick = function () {location.assign(url);};
  }
}

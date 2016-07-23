function escramble() {
  var ps = document.getElementsByTagName("p");
  var a,b,c,d,e,f,g,h,i;
  a = '<a href=\"mai';
  b = 'geoseph';
  c = '\">';
  a += 'lto:';
  b += '@';
  b += 'msn.com';
  e = '</a>';
  f = '';
  g = '<img src=\"';
  h = 'emailme.jpg';
  i = '\" alt="email me"/>'
    if (f) {
      d = f;
    } else if (h) {
      d = g + h + i;
    } else {
      d = b;
    }
  ps[0].innerHTML = a + b + c + d + e;
}

escramble();

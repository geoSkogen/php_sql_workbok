window.onload = initValidate;

function initValidate() {
  var ins = document.getElementsByTagName("input");
  if (ins[3].value == 0 || ins[3].value == 1) {
    document.forms[1].submit();
  }
}

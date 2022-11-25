let userAgent2 = navigator.userAgent;
let browserName;

if (userAgent2.match(/chrome|chromium|crios/i)) {
  browserName = "chrome";
} else if (userAgent2.match(/firefox|fxios/i)) {
  browserName = "firefox";
} else if (userAgent2.match(/safari/i)) {
  browserName = "safari";
} else if (userAgent2.match(/opr\//i)) {
  browserName = "opera";
} else if (userAgent2.match(/edg/i)) {
  browserName = "edge";
} else {
  browserName = "No browser detection";
}
console.log(browserName);

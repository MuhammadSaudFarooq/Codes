var userAgent = window.navigator.userAgent,
  platform =
    window.navigator?.userAgentData?.platform || window.navigator.platform,
  platform = platform.toLowerCase();
(macosPlatforms = [
  "macintosh",
  "macintel",
  "intel mac",
  "macppc",
  "mac68k",
  "mac os",
  "mac",
  "macos",
  "intel mac os",
  "ppc mac os",
]),
  (windowsPlatforms = ["win32", "win64", "windows", "window", "wince"]),
  (iosPlatforms = [
    "iphone",
    "ipad",
    "ipod",
    "ipad simulator",
    "iphone simulator",
    "ipod simulator",
    "ios",
  ]),
  (os = null);

if (macosPlatforms.indexOf(platform) !== -1) {
  os = "Mac OS";
} else if (iosPlatforms.indexOf(platform) !== -1) {
  os = "iOS";
} else if (windowsPlatforms.indexOf(platform) !== -1) {
  os = "Windows";
} else if (/Android/.test(userAgent)) {
  os = "Android";
} else if (/Linux/.test(platform)) {
  os = "Linux";
}

document.getElementById("system_check").innerHTML = os;
console.log(os);

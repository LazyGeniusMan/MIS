document.addEventListener("DOMContentLoaded", function() {
  var selectors = document.querySelectorAll("input");
  selectors.forEach(selector => {
    var numberMask = IMask(selector, {
      mask: Number,
      scale: 10,
      thousandsSeparator: ",",
      normalizeZeros: true,
      min: 0,
      radix: ".",
      mapToRadix: [","]
    });
  });
});

function range() {
var slider = document.getElementById("myRange");
var output = document.getElementById("weightage");
output.value = slider.value;

slider.oninput = function() {
  output.value = this.value;
}

}
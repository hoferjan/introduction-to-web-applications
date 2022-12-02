//if click happens theme_switcher() is called
var theme = document.getElementById('namebutton');
namebutton.addEventListener('click', function() {theme_switcher();});


//function to actually switch the theme
function theme_switcher() {

  // Obtains an array of all <link>
  // elements.
  // Select your element using indexing.
  var theme = document.getElementsByTagName('link')[0];

  // Change the value of href attribute 
  // to change the css sheet.
  if (theme.getAttribute('href') == 'CSS/style.css') {
      theme.setAttribute('href', 'CSS/style2.css');
  } else {
      theme.setAttribute('href', 'CSS/style.css');
  }
}
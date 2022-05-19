
// copy text to clipboard
function copyText(element) {
    var $copyText = document.getElementById(element).innerText;
    var button = document.getElementById(element + '-button');
    navigator.clipboard.writeText($copyText).then(function() {
      var originalText = button.innerText;
      button.innerText = 'Copied!';
      setTimeout(function(){
        button.innerText = originalText;
        }, 5000);
    }, function() {
      button.style.cssText = "background-color: var(--red);";
      button.innerText = 'Error';
    });
  }

// END copy text to clipboard




$(function() {
  $('.pop').on('click', function() {
    console.log('clicked');
    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
    $('#imagemodal').modal('show');   
  });		
});


const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

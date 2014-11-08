
(function()
{
  var
    document = window.document,
    languageForm = document.getElementById('languageForm'),
    languageCode = document.getElementById('languageCode'),
    languageButton = document.getElementById('languageButton');

  languageButton.style.display = 'none';

  languageCode.addEventListener('change', function() {
    languageForm.submit();
  });
})(window);
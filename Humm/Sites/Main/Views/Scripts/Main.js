
$(function()
{
  $('#languageButton').hide();
  $('#languageCode').change(function()
  {
    this.form.submit();
  });
});
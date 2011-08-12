<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Refresh" content="0;url={$app.redirect_url}" />
</head>
<body onload="try {ldelim}self.location.href='{$app.redirect_url}'{rdelim} catch(e) {ldelim}{rdelim}">
  <a href="{$app.redirect_url}">Click here to redirect...</a>
</body>
</html>

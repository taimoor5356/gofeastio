<!DOCTYPE html>
<html>
<body>

<h2>JavaScript</h2>

<h3>The window.location object</h3>

<input type="button" value="Load new document" onclick="newDoc()">

<a href="https://gofeast.page.link/N9CY" target="_self">click
    </a>

<script>
function newDoc() {
//   window.location.assign("chrome://appcache-internals")
//   window.open('https://gofeast.page.link/N9CY')
  window.open('https://gofeast.page.link/N9CY')
  window.location.assign("https://gofeast.page.link/N9CY")
}
</script>

</body>
</html>

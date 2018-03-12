<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<style>
	/* OTHER OPTIONS
	ng-empty
	ng-not-empty
	ng-touched
	ng-untouched
	ng-valid
	ng-invalid
	ng-dirty
	ng-pending
	ng-pristine 
	*/
	input.ng-empty {
	    background-color: red;
	}

	</style>
</head>
<body>
	<form ng-app="" name="myForm">
	    Enter your name:
	    <input name="myName" ng-model="myText" required>
	</form>

	<p>Edit the text field and it will get/lose classes according to the status.</p>
	<p><b>Note:</b> A text field with the "required" attribute is not valid when it is empty.</p>
</body>
</html>
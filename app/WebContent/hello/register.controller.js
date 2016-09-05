sap.ui.controller("hello.register", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.register
*/
//	onInit: function() {
//
//	},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.register
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.register
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.register
*/
//	onExit: function() {
//
//	}
	register: function()
	{
		document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
		var name = this.getView().byId("input0").getValue();    
	    var userId = this.getView().byId("input1").getValue();
	    var password = this.getView().byId("input2").getValue();
	    var email = this.getView().byId("input3").getValue();
	    var phone = this.getView().byId("input4").getValue();
	    var street = this.getView().byId("input5").getValue();
	    var city = this.getView().byId("input6").getValue();
	    var state = this.getView().byId("input7").getValue();
	    var designation = this.getView().byId("input8").getItems();
	    
	   console.log(designation);
	    
	    
	    //window.location = "http://localhost/patient_api/register.php?name=" + name + "&userID=" + userID
	    //+ "&password=" + password + "&email=" + email + "&phone="+ phone + "&street=" + street + "&city=" + city + "&state=" + state
	    //;	

	    
	    $.post('http://localhost/patient_api/register.php',{name:name,userId:userId,password:password,email:email,phone:phone,
	    	street:street,city:city,state:state},
	    		function(data)
	    		{
	    	
	    	if (data == 1)
	    	{
	        app = sap.ui.getCore().byId("appId");
	    	app.to("idprofile");
	    	}
	    	
	    	else
	    	{
	    		alert("Registration Failed, Check if your enteries are correct. You can try another ID. " +
	    				"You can not Register if Email/Phone is already registered if so please use Forgot password feature to reset password");	
	    	}
	    		});
	    
	    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	},
	
	
onNavigation: function()
{
	app = sap.ui.getCore().byId("appId");
    app.to("idlogin");
	}




});
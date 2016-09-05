sap.ui.controller("hello.login", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.login
*/
//onInit: function() {
	
//},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.login
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.login
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.login
*/
//	onExit: function() {
//
//	}
login : function()
{
	
	document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	userId = this.getView().byId("userId").getValue();    
    var password = this.getView().byId("password").getValue();
    
    $.post('patient_api/Index.php',{postuserId:userId,postpassword:password},
    		function(data)
    		{
    	
    	if (data == 1)
    	{
        app = sap.ui.getCore().byId("appId");
    	app.to("idprofile");
    	}
    	
    	else
    	{
    		alert(data);	
    	}
    		});
    
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
},
register : function()
{
    
    
	app = sap.ui.getCore().byId("appId");
	app.to("idregister");
	}

});
sap.ui.controller("hello.logout", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.logout
*/
onInit: function() {
	
},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.logout
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.logout
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.logout
*/
//	onExit: function() {
//
//	}

	onPress : function()
	{

		var view = this.getView();
		var oModel = new sap.ui.model.json.JSONModel();
	    oModel.loadData("patient_api/logout.php",true);
	    view.setModel(oModel);
	    
		app = sap.ui.getCore().byId("appId");
	    app.to("idlogin");
	    
		
	}
	
});
sap.ui.controller("hello.medicin_search", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.search_medicin
*/
	onInit: function() {
        
		var view = this.getView();
		var oModel = new sap.ui.model.json.JSONModel();
	    oModel.loadData("http://localhost/patient_api/medicin_search.php",true);
	    view.setModel(oModel);
		
	},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.search_medicin
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.search_medicin
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.search_medicin
*/
//	onExit: function() {
//
//	}
	
	
	onNavigation: function()
	{
		app = sap.ui.getCore().byId("appId");
	    app.to("idprofile");
		}

});
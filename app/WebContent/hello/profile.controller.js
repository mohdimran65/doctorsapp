sap.ui.controller("hello.profile", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.doctor_profile
*/
	onInit: function() {
		
		var view = this.getView();
		var oModel = new sap.ui.model.json.JSONModel();
	    oModel.loadData("http://localhost/patient_api/profile.php",true);
	    view.setModel(oModel);
	    
	},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.doctor_profile
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.doctor_profile
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.doctor_profile
*/
//	onExit: function() {
//
//	}

	handlePressConfiguration : function(oEvent)
	{
		var oItem = oEvent.getSource();
		var oShell = this.getView().byId("myShell");
		var bState = oShell.getShowPane();
		oShell.setShowPane(!bState);
		oItem.setShowMarker(!bState);
		oItem.setSelected(!bState);
	},
	
	handleLoginPress : function()
	{
	
		app = sap.ui.getCore().byId("appId");
	    app.to("idlogin");
		
	},
	
	AddPatient : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idpatient_add");
	},
	
	SearchPatient : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idpatient_search");
	},
	
	AddMedicine : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idmedicine_add");
	},
	
	SearchMedicine : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idmedicine_search");
	},
	
	SeePatient: function()
	{
		app = sap.ui.getCore().byId("appId");
	    app.to("idsee_patient");	
	},
	SearchPatient : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("masterPage");
	}
	
});
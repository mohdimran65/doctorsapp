sap.ui.define([
		"jquery.sap.global",
		"sap/ui/core/mvc/Controller",
		"sap/ui/model/Filter",
		"sap/ui/model/json/JSONModel",
		"sap/ui/core/routing/Router",
		"sap/ui/core/UIComponent"
	], function(jQuery, Controller, Filter, JSONModel,Router) {
	"use strict";

sap.ui.controller("hello.patient_search", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.patient_search
*/
	onInit: function() {
   
		var oModel = new sap.ui.model.json.JSONModel();
	    oModel.loadData("patient_api/patient_search.php",false);
	    sap.ui.getCore().setModel(oModel);

},

getRouter : function () {
	return sap.ui.core.UIComponent.getRouterFor(this);
},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.patient_search
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.patient_search
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.patient_search
*/
//	onExit: function() {
//
//	}

onSearchPatient : function (oEvt) {
	 
	// add filter for search
	var aFilters = [];
	var sQuery = oEvt.getSource().getValue();
	if (sQuery && sQuery.length > 0) {
		var filter = new Filter("PATIENT_NAME", sap.ui.model.FilterOperator.Contains, sQuery);
		aFilters.push(filter);
	}

	// update list binding
	var list = this.getView().byId("PatientTable");
	var binding = list.getBinding("items");
	binding.filter(aFilters, "Application");
},


onPress : function (oEvent) {
	// The source is the list item that got pressed
	alert(this._showObject(oEvent.getSource()));
},

_showObject: function(oItem) {
	this.getRouter().navTo("patient_details", {
		objectId: oItem.getBindingContext().getProperty("PATIENT_ID")
	});
},

	onNavigation : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idprofile");
	}
	
	
	
});

});
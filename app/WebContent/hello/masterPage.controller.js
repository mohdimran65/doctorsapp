sap.ui.define([
		'jquery.sap.global',
		'sap/ui/core/mvc/Controller',
		'sap/ui/model/Filter',
		'sap/ui/model/json/JSONModel'
	], function(jQuery, Controller, Filter, JSONModel) {
	"use strict";
sap.ui.controller("hello.masterPage", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf splitapp.masterPage
*/
onInit: function() {
	var oModel = new sap.ui.model.json.JSONModel("patient_api/patient_detail.php");
	 sap.ui.getCore().setModel(oModel,'data');
},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf splitapp.masterPage
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf splitapp.masterPage
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf splitapp.masterPage
*/
//	onExit: function() {
//
//	}

itemSelected: function(){
	
	var app = sap.ui.getCore().byId("appId");
	var list = this.getView().byId("Patientlist");
	var sItem = list.getSelectedItem();
	var sPath = sItem.oBindingContexts.data.sPath;
	var item = sap.ui.getCore().getModel('data').getProperty(sPath);
	var oModel = new sap.ui.model.json.JSONModel(item);
	sap.ui.getCore().setModel(oModel,'item');
	app.to('detailsPage');
	console.log(list);
		},
		
		onSearchPatient : function (oEvt) {
			 
			// add filter for search
			var aFilters = [];
			var sQuery = oEvt.getSource().getValue();
			if (sQuery && sQuery.length > 0) {
				var filter = new Filter("PATIENT_NAME", sap.ui.model.FilterOperator.Contains, sQuery);
				aFilters.push(filter);
			}

			// update list binding
			var list = this.getView().byId("Patientlist");
			var binding = list.getBinding("items");
			binding.filter(aFilters, "Application");
		},
		
		onNavigationMaster: function()
		{
			app = sap.ui.getCore().byId("appId");
			app.to("idprofile");
		}

});
});

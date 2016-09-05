sap.ui.define([
		'jquery.sap.global',
		'sap/ui/core/mvc/Controller',
		'sap/ui/model/Filter',
		'sap/ui/model/json/JSONModel'
	], function(jQuery, Controller, Filter, JSONModel) {
	"use strict";

sap.ui.controller("hello.detailsPage", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf splitapp.detailsPage
*/
	onInit: function() {

		
		var oModel1 = new sap.ui.model.json.JSONModel();
	    oModel1.loadData("patient_api/medicin_search.php",true);
	    sap.ui.getCore().setModel(oModel1,'medicine_data');
	    
	    var oModel2 = new sap.ui.model.json.JSONModel();
	    oModel2.loadData("patient_api/disease.php",true);
	    sap.ui.getCore().setModel(oModel2,'disease_data');
	   
},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf splitapp.detailsPage
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf splitapp.detailsPage
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf splitapp.detailsPage
*/
//	onExit: function() {
//
//	}

onSearchDisease : function (oEvt) {
	 
	// add filter for search
	var aFilters = [];
	var sQuery = oEvt.getSource().getValue();
	if (sQuery && sQuery.length > 0) {
		var filter = new Filter("DISEASE_NAME", sap.ui.model.FilterOperator.Contains, sQuery);
		aFilters.push(filter);
	}

	// update list binding
	var list = this.getView().byId("DiseaseList");
	var binding = list.getBinding("items");
	binding.filter(aFilters, "Application");
},

onSearchMedicine : function (oEvt) {
	 
	// add filter for search
	var aFilters = [];
	var sQuery = oEvt.getSource().getValue();
	if (sQuery && sQuery.length > 0) {
		var filter = new Filter("NAME", sap.ui.model.FilterOperator.Contains, sQuery);
		aFilters.push(filter);
	}

	// update list binding
	var list = this.getView().byId("MedicineList");
	var binding = list.getBinding("items");
	binding.filter(aFilters, "Application");
},

onPress : function(){

	var list = this.getView().byId("MedicineList");
	var sItem = list.getSelectedItem();
	var sPath = sItem.oBindingContexts.medicine_data.sPath;
	var item = sap.ui.getCore().getModel('medicine_data').getProperty(sPath);
	var r = JSON.stringify(item);
	

	var list1 = this.getView().byId("DiseaseList");
	var sItem1 = list1.getSelectedItem();
	var sPath1 = sItem1.oBindingContexts.disease_data.sPath;
	var item1 = sap.ui.getCore().getModel('disease_data').getProperty(sPath1);
	var r1 = JSON.stringify(item1);

	var userId = this.getView().byId("USERID").getValue();
	
	 $.post('patient_api/medicine_add.php',{item:r,item1:r1,USERID:userId},
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
	 
},
onProfileNavigation : function()
{
    
    
	app = sap.ui.getCore().byId("appId");
	app.to("idprofile");
	}
});
});
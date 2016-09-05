sap.ui.controller("hello.medicin_add", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.add_medicin
*/
//	onInit: function() {
//
//	},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.add_medicin
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.add_medicin
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.add_medicin
*/
//	onExit: function() {
//
//	}
	
	onAdd: function()
	{
	var medicine = this.getView().byId("medicine").getValue();    
    var power = this.getView().byId("power").getValue();
    var brand = this.getView().byId("brand").getValue();
    var speciality = this.getView().byId("speciality").getValue();
    
    
    
    //var designation = this.getView().byId("input8").getValue();
    

        
    $.post('http://localhost/patient_api/medicine_add.php',{medicine:medicine,power:power,brand:brand,speciality:speciality},
    		function(data)
    		{
    	
    	if (data == 1)
    	{
    		alert("Medicine Added Successfully");
    	}
    	
    	else
    	{
    		alert("Adding Medicine Failed");	
    	}
    		});
    
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
},
	
	onNavigation: function()
	{
		app = sap.ui.getCore().byId("appId");
	    app.to("idprofile");
		}

});
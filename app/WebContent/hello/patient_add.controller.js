sap.ui.controller("hello.patient_add", {

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf hello.patient_add
*/
onInit: function() {

	var oModel2 = new sap.ui.model.json.JSONModel();
    oModel2.loadData("http://localhost/patient_api/doctor.php",true);
    sap.ui.getCore().setModel(oModel2,'doctor_data');
	
},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf hello.patient_add
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf hello.patient_add
*/
//	onAfterRendering: function() {
//
//	},

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf hello.patient_add
*/
//	onExit: function() {
//
//	}

	AddPatient : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idpatient_add");
	},	
	
	onNavigation : function()
	{
		 app = sap.ui.getCore().byId("appId");
		    app.to("idprofile");
	},
	
	onAddPatient: function()
	{
		document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
		var name = this.getView().byId("input0").getValue();    
	    var email = this.getView().byId("input1").getValue();
	    var phone = this.getView().byId("input2").getValue();
	    var street = this.getView().byId("input3").getValue();
	    var city = this.getView().byId("input4").getValue();
	    var state = this.getView().byId("input5").getValue();
	    
	    var list = this.getView().byId("DoctorList");
		var sItem = list.getSelectedItem();
		var sPath = sItem.oBindingContexts.doctor_data.sPath;
		var item = sap.ui.getCore().getModel('doctor_data').getProperty(sPath);
		var r = JSON.stringify(item);
		console.log(r);
	    
	    //window.location = "http://localhost/patient_api/register.php?name=" + name + "&userID=" + userID
	    //+ "&password=" + password + "&email=" + email + "&phone="+ phone + "&street=" + street + "&city=" + city + "&state=" + state
	    //;	

	    
	    $.post('http://localhost/patient_api/add_patient.php',{name:name,email:email,phone:phone,
	    	street:street,city:city,state:state,doctor_seq:r},
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
	}
	
});
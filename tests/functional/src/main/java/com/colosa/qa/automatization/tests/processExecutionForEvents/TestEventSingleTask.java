package com.colosa.qa.automatization.tests.processExecutionForEvents;

import org.junit.Assert;
import org.junit.AfterClass;
import org.junit.Test;

import com.colosa.qa.automatization.pages.*;
import com.colosa.qa.automatization.common.*;
import org.openqa.selenium.WebElement;

import java.io.FileNotFoundException;
import java.io.IOException;

public class TestEventSingleTask{

	@Test
	public void runProcess() throws Exception{
		Pages.Login().gotoUrl();
		Pages.Login().loginUser("admin","admin","workflow");
    Pages.Main().goHome();
    int casenumber=Pages.Home().startCase("Event Process - Intermediate Conditional_Single Task (Task 1)");
    openCaseFrame();
    FormFieldData[] fieldArray=new FormFieldData[4];
    fieldArray[0]=new FormFieldData();
    fieldArray[1]=new FormFieldData();
    fieldArray[2]=new FormFieldData();
    fieldArray[3]=new FormFieldData();

    fieldArray[0].fieldPath="form[nombre]";
    fieldArray[0].fieldFindType=FieldKeyType.ID;
    fieldArray[0].fieldType=FieldType.TEXTBOX;
    fieldArray[0].fieldValue="rodrigo ivan";

    fieldArray[1].fieldPath="form[apellido]";
    fieldArray[1].fieldFindType=FieldKeyType.ID;
    fieldArray[1].fieldType=FieldType.TEXTBOX;
    fieldArray[1].fieldValue="lea plaza chavez";

    fieldArray[2].fieldPath="form[pais]";
    fieldArray[2].fieldFindType=FieldKeyType.ID;
    fieldArray[2].fieldType=FieldType.DROPDOWN;
    fieldArray[2].fieldValue="bolivia";

    fieldArray[3].fieldPath="form[guardar]";
    fieldArray[3].fieldFindType=FieldKeyType.ID;
    fieldArray[3].fieldType=FieldType.BUTTON;
    fieldArray[3].fieldValue="";

    Assert.assertTrue(FormFiller.formFillElements(fieldArray));
    	Assert.assertTrue(Pages.InputDocProcess().continuebtn());
    Pages.Main().logout();
//Browser.getElement("TestSimpleProcess.webelement.continue").click();
    openTask2(casenumber);
}

	public void openTask2(int casenumber) throws Exception{
		Pages.Login().gotoUrl();
		Pages.Login().loginUser("iver","sample","");
    Pages.Main().goHome();
		opencase(casenumber);
		openCaseFrame();
		FormFieldData[] fieldArray2=new FormFieldData[2];

		fieldArray2[0]=new FormFieldData();
		fieldArray2[1]=new FormFieldData();

		fieldArray2[0].fieldPath="form[tipocuenta][ahorro]";
		fieldArray2[0].fieldFindType=FieldKeyType.ID;
		fieldArray2[0].fieldType=FieldType.RADIOBUTTON;
		fieldArray2[0].fieldValue="";

		fieldArray2[1].fieldPath="form[send]";
		fieldArray2[1].fieldFindType=FieldKeyType.ID;
		fieldArray2[1].fieldType=FieldType.BUTTON;
		fieldArray2[1].fieldValue="";

     Assert.assertTrue(FormFiller.formFillElements(fieldArray2));
    	Assert.assertTrue(Pages.InputDocProcess().continuebtn());
    Pages.Main().logout();
        openTask3(casenumber);

	}

	public void openTask3(int casenumber) throws Exception{
		Pages.Login().gotoUrl();
		Pages.Login().loginUser("hector","sample","");
    Pages.Main().goHome();
		opencase(casenumber);
		openCaseFrame();
		FormFieldData[] fieldArray3=new FormFieldData[2];

		fieldArray3[0]=new FormFieldData();
		fieldArray3[1]=new FormFieldData();

		fieldArray3[0].fieldPath="form[aprobado]";
		fieldArray3[0].fieldFindType=FieldKeyType.ID;
		fieldArray3[0].fieldType=FieldType.DROPDOWN;
		fieldArray3[0].fieldValue="Yes";

		fieldArray3[1].fieldPath="form[send]";
		fieldArray3[1].fieldFindType=FieldKeyType.ID;
		fieldArray3[1].fieldType=FieldType.BUTTON;
		fieldArray3[1].fieldValue="";

     Assert.assertTrue(FormFiller.formFillElements(fieldArray3));
    	Assert.assertTrue(Pages.InputDocProcess().continuebtn());
    Pages.InputDocProcess().continuebtn();
	}

	public void openCaseFrame() throws Exception{
	    Browser.driver().switchTo().defaultContent();
		Browser.driver().switchTo().frame("casesFrame");
		Browser.driver().switchTo().frame("casesSubFrame");
		Browser.driver().switchTo().frame("openCaseFrame");
}
public void opencase(int casenumber)throws Exception{
Pages.Home().openCase(casenumber);
}

}
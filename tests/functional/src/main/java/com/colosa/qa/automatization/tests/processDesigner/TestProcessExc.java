package com.colosa.qa.automatization.tests.ProcessDesigner;

import org.junit.Assert;
import org.junit.AfterClass;
import org.junit.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import com.colosa.qa.automatization.pages.*;
import com.colosa.qa.automatization.common.*;

import java.io.FileNotFoundException;
import java.io.IOException;

public class TestProcessExc{
	@Test
	public void createProcess() throws FileNotFoundException, IOException, Exception{

		Pages.Login().gotoUrl();
		Pages.Login().loginUser("admin", "admin", "workflow");
		Pages.Main().goDesigner();
		Pages.ProcessList().newProcess("TestNewProcess"+new java.util.Date().toString(), "just another test process");
		Assert.assertTrue(Pages.Designer().createTask());
		Pages.Designer().moveTask("Task 1", -100, -300);
		Assert.assertTrue(Pages.Designer().createTask());
		Pages.Designer().moveTask("Task 2", -300, -150);
		Assert.assertTrue(Pages.Designer().initialTask("Task 1"));
		Assert.assertTrue(Pages.Designer().sequential("Task 1", "Task 2"));
		Assert.assertTrue(Pages.Designer().endTask("Task 2"));
                
	}
}
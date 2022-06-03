  <section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span8">
            <h3> Easy Way Automation</h3>
            <p>সহজ করে  সেলেনিয়াম শিখি....</p>
          </div>
          <div class="span4">
            <div class="input-append">
              <form class="form-search">
                <input type="text" class="input-medium search-query">
                <button type="submit" class="btn btn-inverse">Search</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="maincontent">
    <div class="container">
      <div class="row">
        <!--<div class="span12">-->
          <!-- <h2>basic</h2> -->


      
      
      
        <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 4px; text-align: center; border-style: solid; border-color: black; border-radius: 5px; background-color: #ffbb00;" class="well-primary">
                <h2 style="color: black; text-align: center;">package</h2>
                <!-- <h3 style="color: black; text-align: center;">Get Attribute by WebElement</h3> -->
              </div>
              </a>
            </div>
      
      
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 50px; text-align: left; border-style: solid; border-color: black; border-radius: 5px; background-color: #333;" class="well-primary">
             
             <!--<p>There are eight primitive datatypes supported by Java. Primitive datatypes are predefined by the language and named by a keyword. Let us now look into the eight primitive data types in detail.</p>-->
             
             <ol type="1">
                  <li><p style="color: white; text-align: left;">What is package?
Answer: A package is a group of classes, interfaces and sub-packages. It provides access protection and removes naming collision/CONFLICT.
</p></li>
                  <li><p style="color: white; text-align: left;">Do I need to import java.lang package any time? Why if so?
Answer: No. It is by default loaded FROM JVM.
p></li>
                  <li><p style="color: white; text-align: left;">Which package is imported by default?
java.lang package is imported by default even without a package declaration.
p></li>

<li><p style="color: white; text-align: left;">Can I import same package/class twice? Will the JVM load the package twice at runtime?
Answer: 
JVM will internally load class only one time, no matter how many times you import the same class.

p></li>

<li><p style="color: white; text-align: left;">Can a class declared as private be accessed outside it's package?
Not possible.


p></li>
                   
           </ol>  
           
              </div>
              </a>
            </div>
      
      
      </br></br>
       <div style="margin-top: 12px;" class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 4px; text-align: center; border-style: solid; border-color: black; border-radius: 5px; background-color: #ffbb00;" class="well-primary">
                <h2 style="color: black; text-align: center;">Get attri by WebElement</h2>
                <!-- <h3 style="color: black; text-align: center;">Get Attribute by WebElement</h3> -->
              </div>
              </a>
            </div>
      
            
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 50px; text-align: left; border-style: solid; border-color: black; border-radius: 5px; background-color: #333;" class="well-primary">
             
             <p>There are eight primitive datatypes supported by Java. Primitive datatypes are predefined by the language and named by a keyword. Let us now look into the eight primitive data types in detail.</p>
             
             <ol type="1">
                  <li><p style="color: white; text-align: left;">Hi my name is ... I have been working as a SQA for last 8 years. I started my career as a manual tester and slowly getting into automation. In my current project the company I am working I have set of functional test cases that are executed manually. Test cases verify functionality of a web application and validates if an expected result is there or not.
As an automation tester my goal is to automate all the test cases. To do that: From the scratch,
I create a project using an IDE like Eclipse and add 2 libraries to it. I am using java because , mostly known and easy to work with developers. 
 Which is Selenium web driver library:   This is automation code to interact with browser.
</p></li>
                  <li><p style="color: white; text-align: left;">I create a project using an IDE like Eclipse and add 2 libraries to it. I am using java because , mostly known and easy to work with developers. 
 Which is Selenium web driver library:   This is automation code to interact with browser.
We use standardized maven project for build, execution, and Dependency management. And page object model design pattern, reason using POM; it gives us few advantages like, we can divide our project into smaller builds based on size of the pages. For every page, we have one page object class. So we give the page class name according to the page name. 
Examples: product listing page, add to the cart page, payment page and invoice generation page. Each page identifies what is the functionality we are coding, developing and implementing. We named same way the test class. We notice sometime some of the pages have more functionality; in that case we had to create multiple page class based on the area of the page.  If there is lots of functionality in the same page, in that case we use common generic method.
In my last project it was Cucumber framework----- In my cucumber framework I have use few components like, 
We Have Test Base class. Test Base class controls our execution such as, how our browser will open. How much implicit wait time we need in our code for execution time, everything I setup in my Test Base class file. Also,when our machine is setup, how is going to run like (local machine or remote machine). Then what kind of browser it will run. Do I need any database connection? 
We use common shared library, in my common shared library I have common method. I use all of the common method for my coding. Like I have shared library for the common functionalities to click, send Keys, select form list, dropdown etc. 
We have common method such as for Assert, I had to create common functionality to handle the assertion, Sometimes we had to use JavaScriptExecutor to handle the javaScript scenario. For that I had to create common library as well.
For data Driven, we read our data from excel or csv file we have common shared library for that as well.
We have listener class which helps us to take web elements, if selenium first time fails to locate the elements. I have code for logger class to get the log report. Log report helps me to look for any issue and debugging, such as how the execution is going and which steps  is passing, if scenario fails,  which one and why is failing. 
I have config file. Inside the config file I have properties file. In the properties file I have all the configuration, like which browser, which environment my script will run. Will it run local or remote machine?  I have test data and driver exe file in this package. 
We are using log4j library to maintain logging or our project. I am using all kinds of logging statements like info, debug, error etc. we have use log4j properties of this framework in a xml file or properties file and added that file on to build path.
We are using maven postman plugin/java api to send generated extent reports as an attachment to client distribution list.
Make sure checking my code into client repository using version controlling took GIT.
Also I have our Test Script for all the Test Classes. In the Test Class I used @Test annotation and I create object of the page object class and I call the method and I run the entire test scenario. Based on the test scenario I have given the method name. I named my init Class I create objects for all of my page classes. Init Class, helps me to get one common page object. If I have 20 page class objects, for the 20 page class, I do not need to create 20 objects. I just create one object of my init page class, in my test class; it helps me to call any method from any page object class. Besides that, in my framework, I have four types of report, default TestNG html report, log report, screenshot report and custom extent Report html report. Extent Report has a color dashboard to have clear view pie chart regarding total execution result, how many test scenarios pass or fail, total execution time and screenshot of fail test scenarios. Then I have regressionSuite.xml which runs all our regression test scenarios. In our framework, we have CI/ CD integration. We keep our code in GitLab. We have a project in Jenkins to kick off our scripts two times daily in remote grid machine to reduce the execution time and to run in different operating system, browsers and environments. also logging, emailing, page factory annotations TestNg, exception handling, build tool, version controlling tool etc.

</p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                   
           </ol>  
           
              </div>
              </a>
            </div>
      
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 4px; text-align: center; border-style: solid; border-color: black; border-radius: 5px; background-color: #ffbb00;" class="well-primary">
                <h2 style="color: black; text-align: center;">Get attri by WebElement</h2>
                <!-- <h3 style="color: black; text-align: center;">Get Attribute by WebElement</h3> -->
              </div>
              </a>
            </div>
      
      
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 50px; text-align: left; border-style: solid; border-color: black; border-radius: 5px; background-color: #333;" class="well-primary">
             
             <p>There are eight primitive datatypes supported by Java. Primitive datatypes are predefined by the language and named by a keyword. Let us now look into the eight primitive data types in detail.</p>
             
             <ol type="1">
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                   
           </ol>  
           
              </div>
              </a>
            </div>
            
            <div style="margin-top: 12px;" class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 4px; text-align: center; border-style: solid; border-color: black; border-radius: 5px; background-color: #ffbb00;" class="well-primary">
                <h2 style="color: black; text-align: center;">Get attri by WebElement</h2>
                <!-- <h3 style="color: black; text-align: center;">Get Attribute by WebElement</h3> -->
              </div>
              </a>
            </div>
      
      
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 50px; text-align: left; border-style: solid; border-color: black; border-radius: 5px; background-color: #333;" class="well-primary">
             
             <p>There are eight primitive datatypes supported by Java. Primitive datatypes are predefined by the language and named by a keyword. Let us now look into the eight primitive data types in detail.</p>
             
             <ol type="1">
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                   
           </ol>  
           
              </div>
              </a>
            </div>
            
            <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 4px; text-align: center; border-style: solid; border-color: black; border-radius: 5px; background-color: #ffbb00;" class="well-primary">
                <h2 style="color: black; text-align: center;">Get attri by WebElement</h2>
                <!-- <h3 style="color: black; text-align: center;">Get Attribute by WebElement</h3> -->
              </div>
              </a>
            </div>
      
      
      <div class="span12">
              <a style="text-decoration: none;" href="#"><div style="padding: 50px; text-align: left; border-style: solid; border-color: black; border-radius: 5px; background-color: #333;" class="well-primary">
             
             <p>There are eight primitive datatypes supported by Java. Primitive datatypes are predefined by the language and named by a keyword. Let us now look into the eight primitive data types in detail.</p>
             
             <ol type="1">
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                  <li><p style="color: white; text-align: left;">আমরা দেখবো কিভাবে পেজ থেকে Attribute নিতে হয়। </p></li>
                   
           </ol>  
           
              </div>
              </a>
            </div>
      

    </div>
  </section>
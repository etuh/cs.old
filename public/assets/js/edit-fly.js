function editFly(element) {
    var fly_code = element.getAttribute('data-flycode');
    console.log("edit function called with fly_code = ", fly_code);
    // Get the values of each cell
    var fly_name = document.getElementById("fly_name_" + fly_code).innerHTML;
    var flyCode = document.getElementById("fly_code_" + fly_code).innerHTML;
    var fly_description = document.getElementById("fly_description_" + fly_code).innerHTML;
    var barcode = document.getElementById("barcode_" + fly_code).innerHTML;
    var cost = document.getElementById("cost_" + fly_code).innerHTML;
  
    // Replace the cell values with input fields
    document.getElementById("fly_code_" + fly_code).innerHTML = "<input type='text' id='input_fly_code_" + fly_code + "' value='" + fly_code + "'>";
    document.getElementById("fly_name_" + fly_code).innerHTML = "<input type='text' id='input_fly_name_" + fly_code + "' value='" + fly_name + "'>";
    document.getElementById("fly_description_" + fly_code).innerHTML = "<input type='text' id='input_fly_description_" + fly_code + "' value='" + fly_description + "'>";
    document.getElementById("barcode_" + fly_code).innerHTML = "<input type='text' id='input_barcode_" + fly_code + "' value='" + barcode + "'>";
    document.getElementById("cost_" + fly_code).innerHTML = "<input type='text' id='input_cost_" + fly_code + "' value='" + cost + "'>";
  
    // Replace the "Edit" button with a "Save" button
    // document.getElementById("edit_" + fly_code).innerHTML = "<button id='save_" + fly_code + "'data-flycode='"+ fly_code +" onclick='console.log(\"Save button clicked\");  save(" + fly_code + ")'>Save</button>";
    document.getElementById("edit_" + flyCode).innerHTML = "Save";
    document.getElementById("edit_" + flyCode).setAttribute("data-flycode", fly_code);
    document.getElementById("edit_" + flyCode).setAttribute("onclick", "saveFly(this);");
    document.getElementById("edit_" + flyCode).setAttribute("id", "save_"+ fly_code);
  }

function saveFly(element) {
    var fly_code = element.getAttribute('data-flycode');
    console.log("save function called with fly_code = ", fly_code);
  
    // Get the values from the input fields
    var newFlyCode = document.getElementById("input_fly_code_" + fly_code).value;
    var newFlyName = document.getElementById("input_fly_name_" + fly_code).value;
    var newDescription = document.getElementById("input_fly_description_" + fly_code).value;
    var newBarcode = document.getElementById("input_barcode_" + fly_code).value;
    var newCost = document.getElementById("input_cost_" + fly_code).value;
  
      // Send an AJAX request to your server to update the database
        var flycodeTd = document.createElement("td");
        flycodeTd.setAttribute("id", "fly_code_" + newFlyCode);
        flycodeTd.innerHTML = newFlyCode;
        document.getElementById("input_fly_code_" + fly_code).outerHTML = flycodeTd.outerHTML;

        var flynameTd = document.createElement("td");
        flynameTd.setAttribute("id", "fly_name_" + newFlyName);
        flynameTd.innerHTML = newFlyName;
        document.getElementById("input_fly_name_" + fly_code).outerHTML = flynameTd.outerHTML;

        var flydescriptionTd = document.createElement("td");
        flydescriptionTd.setAttribute("id", "fly_description_" + newDescription);
        flydescriptionTd.innerHTML = newDescription;
        document.getElementById("input_fly_description_" + fly_code).outerHTML = flydescriptionTd.outerHTML;

        var barcodeTd = document.createElement("td");
        barcodeTd.setAttribute("id", "barcode_" + newBarcode);
        barcodeTd.innerHTML = newBarcode;
        document.getElementById("input_barcode_" + fly_code).outerHTML = barcodeTd.outerHTML;

        var costTd = document.createElement("td");
        costTd.setAttribute("id", "cost_" + newCost);
        costTd.innerHTML = newCost;
        document.getElementById("input_cost_" + fly_code).outerHTML = costTd.outerHTML;
 
    document.getElementById("save_" + fly_code).innerHTML = "Edit";
    document.getElementById("save_" + fly_code).setAttribute("data-flycode", newFlyCode);
    document.getElementById("save_" + fly_code).setAttribute("onclick", "editFly(this)");
    document.getElementById("save_" + newFlyCode).setAttribute("id", "edit_"+ fly_code);
  
  // Use AJAX to submit the changes to the server
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "admin/data-process/update-fly.php", true); 
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id="+ fly_code +"&fly_code=" + newFlyCode + "&fly_name=" +newFlyName + "&fly_description=" + newDescription + "&cost=" + newCost + "&barcode=" + newBarcode);
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Handle the response from the server
      var response = JSON.parse(this.responseText);
      if (response.success) {
        // Show a success message
        alert("Changes saved successfully");
      } else {
        // Show an error message
        alert("An error occurred while saving the changes");
      }
    }
  };
  }
function viewNotes(flyCode) {
    var notesRow = document.getElementById('notes_row_' + flyCode);
    notesRow.style.display = notesRow.style.display === 'none' ? 'table-row' : 'none';
    }

function showOrderDetails(element) {
  var orderNo = element.getAttribute('data-orderno');

  $.ajax({
      url: '/suborder/'+ orderNo,
      success: function(response) {
          $('#details-container-'+ orderNo).html(response);
          $('#details-container-'+ orderNo).closest('td').show();
      }
  });
}

function showWorkDetails(element) {
  var orderId = element.getAttribute('data-orderid');
  
  $.ajax({
      url: '/jobs/'+ orderId,
      success: function(response) {
          $('#view-container-'+ orderId).html(response);
          $('#view-container-'+ orderId).closest('td').show();
      }
  });

}
    
let count = 0;
function assignStaff() {
  count++;
  let container = document.getElementById("jobs-table");
  let newRow = document.createElement("tr");
  newRow.innerHTML = `<td><input type="text" name="staffname${count}" id="staffname${count}" form="assignform" /></td><td><input type="text" name="staffid${count}" id="staffid${count}" form="assignform" /></td><td><input type="text" name="qty${count}" id="qty${count}" form="assignform" /></td>`;
  container.appendChild(newRow);
}
function removeLast() {
  if (count > 0) {
    let container = document.getElementById("jobs-table");
    let lastRow = container.lastChild;
    container.removeChild(lastRow);
    count--;
  }
}
function saveCount(){
  let container = document.getElementById("jobs-table");
  let newRow = document.createElement("tr");
  newRow.innerHTML = `<td><input type="hidden" name="count" value="${count}" form="assignform" /></td>`;
  container.appendChild(newRow);
}
function search() {
  // Get the search term and column
  const term = document.getElementById("search").value;
  const column = document.getElementById("search-select").value;

  // Send the search request to the server
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "search.php?term=" + encodeURIComponent(term) + "&column=" + encodeURIComponent(column), true);
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Display the results
      document.getElementById("results").innerHTML = this.responseText;
    }
  };
  xhr.send();
}
  
function markasdone(jobid){
    // document.getElementById("jobincomplete").innerHTML= '<td><div id="jobcomplete" class="badge badge-outline-success" onclick"markAsDone()">Complete</div></td>';
    $.ajax({
      url: 'jobs/complete',
      type: 'POST',
      data: {jid: jobid},
      success: function(data) {
        console.log('Request succeeded:', data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Request failed:', textStatus, errorThrown);
      },
      complete: function(jqXHR, textStatus) {
        console.log('Request completed with status:', textStatus);
      }
    });
    
}
function editUser(userid) {
  console.log("edit function called with userid = ", userid);
// Get the values of each cell
var uname = document.getElementById("uname_" + userid).innerHTML;
var utype = document.getElementById("utype_" + userid).innerHTML;
var name = document.getElementById("name_" + userid).innerHTML;

// Replace the cell values with input fields
document.getElementById("uname_" + userid).innerHTML = "<input type='text' id='input_fly_code_" + userid + "' value='" + uname + "'>";
document.getElementById("utype_" + userid).innerHTML = "<input type='text' id='input_utype_" + userid + "' value='" + utype + "'>";
document.getElementById("name_" + userid).innerHTML = "<input type='text' id='input_fly_name_" + userid + "' value='" + name + "'>";

if(utype=='user'){
  var staffid = document.getElementById("staffid_" + userid).innerHTML;
  var stafftype = document.getElementById("stafftype_" + userid).innerHTML;

  document.getElementById("staffid_" + userid).innerHTML = "<input type='text' id='input_fly_description_" + userid + "' value='" + staffid + "'>";
  document.getElementById("stafftype_" + userid).innerHTML = "<input type='text' id='input_barcode_" + userid + "' value='" + stafftype + "'>";

}

document.getElementById("edit_" + userid).innerHTML = "Save";
document.getElementById("edit_" + userid).setAttribute("onclick", "saveUser("+userid+");");
document.getElementById("edit_" + userid).setAttribute("id", "save_"+ userid);
}

function saveUser(userid) {
console.log("save function called with userid = ", userid);

// Get the values from the input fields
var newFlyCode = document.getElementById("input_fly_code_" + userid).value;
var newFlyName = document.getElementById("input_fly_name_" + userid).value;
var newUtype = document.getElementById("input_utype_" + userid).value;
 // Send an AJAX request to your server to update the database
    var flycodeTd = document.createElement("td");
    flycodeTd.setAttribute("id", "uname_" + userid);
    flycodeTd.innerHTML = newFlyCode;
    document.getElementById("input_fly_code_" + userid).outerHTML = flycodeTd.outerHTML;

    var flynameTd = document.createElement("td");
    flynameTd.setAttribute("id", "fly_name_" + userid);
    flynameTd.innerHTML = newFlyName;
    document.getElementById("input_fly_name_" + userid).outerHTML = flynameTd.outerHTML;

    var utypeTd = document.createElement("td");
    utypeTd.setAttribute("id", "utype_" + userid);
    utypeTd.innerHTML = newUtype;
    document.getElementById("utype_" + userid).outerHTML = utypeTd.outerHTML;

  if(utype=='user'){
    var newDescription = document.getElementById("input_fly_description_" + userid).value;
    var newBarcode = document.getElementById("input_barcode_" + userid).value; 

    var flydescriptionTd = document.createElement("td");
    flydescriptionTd.setAttribute("id", "fly_description_" + userid);
    flydescriptionTd.innerHTML = newDescription;
    document.getElementById("input_fly_description_" + userid).outerHTML = flydescriptionTd.outerHTML;

    var barcodeTd = document.createElement("td");
    barcodeTd.setAttribute("id", "barcode_" + userid);
    barcodeTd.innerHTML = newBarcode;
    document.getElementById("input_barcode_" + userid).outerHTML = barcodeTd.outerHTML;
  }

document.getElementById("save_" + userid).innerHTML = "Edit";
document.getElementById("save_" + userid).setAttribute("onclick", "editUser("+userid+")");
document.getElementById("save_" + userid).setAttribute("id", "edit_"+ userid);

// Use AJAX to submit the changes to the server
var xhttp = new XMLHttpRequest();
xhttp.open("POST", "admin/data-process/update-users.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("id="+ userid +"&username=" + newFlyCode + "&fly_name=" +newFlyName + "&fly_description=" + newDescription + "&cost=" + newCost + "&barcode=" + newBarcode);

xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  // Handle the response from the server
  var response = JSON.parse(this.responseText);
  if (response.success) {
    // Show a success message
    alert("Changes saved successfully");
  } else {
    // Show an error message
    alert("An error occurred while saving the changes");
  }
}
};
}
import $ from "jquery";
global.$ = global.jQuery = $;

$(function () {
  //testing:alert("please!");
  var $newItemButton = $("#newItemButton");
  var $newItemForm = $("#newItemForm");
  var $textInput = $("input:text");

  $newItemButton.show();
  $newItemForm.hide();

  $("#showForm").on("click", function () {
    $newItemButton.hide();
    $newItemForm.show();
  });

  $newItemForm.on("submit", function (e) {
    e.preventDefault();
    var newText = $("input:text").val();
    $("p:last").after("<p>" + newText + "</p>");
    $newItemForm.hide();
    $newItemButton.show();
    $textInput.val("");
  });

  //add new ingredient to shopping list
  $(".shopping-list-ingredient").on("keydown", function (event) {
    var ingredientName = $(this).val();

    if (event.key === "Enter") {
      console.log(ingredientName);
      $.ajax({
        url: "/shoppingList/addNew",
        //url: "{{path('add_new_ingredient')}}",
        cache: false,
        type: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { ingredient: ingredientName },
        success: function (response) {
          //alert("added ingredient successfully");
          window.location.reload();
        },
        error: function (xhr, status, error) {
          //console.log(xhr);
          //console.log(status);
          //console.log(error);
          alert("Error adding ingredient. Please try again");
          window.location.reload();
        },
      });
    }
  });

  //delete ingredient when checkbox is clicked
  $(".shopping-list-checkbox-1").on("click", function () {
    var checkbox = $(this);
    console.log(checkbox);
    var ingredientToDeleteID = checkbox.data("id");
    console.log(ingredientToDeleteID);
    $.ajax({
      url: "/shoppingList/delete/" + ingredientToDeleteID,
      cache: false,
      type: "POST",
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      data: { id: ingredientToDeleteID },
      success: function (response) {
        $("#ingredient-" + ingredientToDeleteID).css("color", "red");
        $("#ingredient-" + ingredientToDeleteID).fadeOut(700);
        //checkbox.next("input").fadeOut(700);
        //window.location.reload();
      },
      error: function (xhr, status, error) {
        alert("Could not delete ingredient. Please try again");
        window.location.reload();
      },
    });
  });

  /*search for meals by type
  $(".meal-type-button").on("click", function () {
    var mealType = $(this).attr("name");
    $.ajax({
      url: "/all-meals/type/" + mealType,
      cache: false,
      type: "GET",
      //contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      data: { mealType: mealType },
      success: function (response) {
        console.log(response);
        //$(".main-container").html(response);
      },
      error: function (xhr, status, error) {
        console.log(error, xhr);
      },
    });
  });
*/
  //search for meals by name
  $(".search-text-box").on("keydown", function (event) {
    var mealName = $(this).val();
    if (event.key === "Enter") {
      console.log(mealName);
      $.ajax({
        url: "/all-meals/name/" + mealName,
        cache: false,
        type: "GET",
        data: { mealName: mealName },
        success: function (response) {
          console.log(response);
        },
        error: function (xhr, status, error) {
          console.log(error, xhr);
        },
      });
    }
  });

  $("#myModal").on("shown.bs.modal", function () {
    $("#myInput").trigger("focus");
  });
});

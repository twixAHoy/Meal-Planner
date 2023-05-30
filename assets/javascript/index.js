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

  //search box functionality on meal/recipes page
  //keydown will be helpful when doing an on type lookup
  $(".search-box").on("keydown", function (event) {
    var userMealInput = $(this).val();
    //console.log(userMealInput);
    if (event.key === "Enter") {
      $.ajax({
        url: "/search-meal",
        cache: false,
        type: "GET",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { input: userMealInput },
        success: function (response) {
          // window.location.reload();
        },
        error: function (xhr, status, error) {
          alert("Could not find the meal you're looking for.");
          // window.location.reload();
        },
      });
    }
  });

  //add meal to lunch meal plan
  $(".lunch-checkbox").on("click", function () {
    var checkbox = $(this);
    console.log(checkbox);
  });
});

import { MealPlanReader } from "./MealPlanReader";
import { MealPlanWriter } from "./MealPlanWriter";

export class MealPlan {
  constructor() {}

  initialize() {
    this.MealPlanReader = new MealPlanReader();
    this.MealPlanWriter = new MealPlanWriter();
    this.searchByType();
    this.searchByName();
    this.renderRecipeModal();
    this.saveRecipe();
    this.closeModal();
    this.refreshMealsPage();
    //this.createNewRecipe();
  }

  //function that is called on click
  searchByType() {
    $(document).on("click", ".meal-type-button", (event) => {
      var mealType = $(event.target).attr("name");
      console.log(mealType);
      this.MealPlanReader.searchByType(mealType)
        .then((data) => {
          // console.log("Received data:", data);
          $(".main-container").html(data); // Update the content with the received data
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }

  searchByName() {
    var mainContainer = $(".main-container");
    $(document).on("keydown", ".search-text-box", (event) => {
      if (event.key === "Enter") {
        //mainContainer.empty;
        var mealName = $(event.target).val();
        this.MealPlanReader.searchByName(mealName)
          .then((data) => {
            mainContainer.html(data);
          })
          .catch((error) => {
            console.error("Error: ", error);
          });
      }
    });
  }

  refreshMealsPage() {
    var mainContainer = $(".main-container");
    $(document).on("click", ".refresh-arrow", (event) => {
      $(".meals-container").html.empty;
      this.MealPlanReader.refreshMealsPage()
        .then((data) => {
          mainContainer.html(data);
        })
        .catch((error) => {
          console.log(error);
        });
    });
  }

  showRecipe(mealID) {
    $(".recipe-container").empty();
    $("#new-recipe-modal").modal("hide");
    this.MealPlanReader.showRecipe(mealID)
      //.then((response) => response.json())
      .then((data) => {
        $(".recipe-container").append(data);
        $("#new-recipe-modal").modal("show");
        $(".recipe-container").css("display", "block");
      })
      .catch((error) => {
        console.log(error);
      });
  }

  renderRecipeModal() {
    const mealName = $(".meal-name-text");
    mealName.on("click", (event) => {
      var mealID = $(event.currentTarget)
        .closest(".meal-container")
        .find(".meal-id")
        .val();

      this.showRecipe(mealID);
    });
  }

  saveRecipe() {
    $(document).on("click", ".save-recipe", (event) => {
      var recipeDataToSave = [];
      var mealID = $(".meal-id").val();
      $(".recipe-step").each(function () {
        var recipeStep = $(this).val();
        var recipeStepId = $(this).next(".recipeStepID").val();
        recipeDataToSave.push({
          recipeStepId: recipeStepId,
          recipeStepDesc: recipeStep,
        });
      });
      var jsonRecipeData = JSON.stringify(recipeDataToSave);
      this.MealPlanWriter.saveRecipe(jsonRecipeData, mealID)
        .then((data) => {
          console.log("success");
        })
        .catch((error) => {
          console.log(error);
        });
    });
  }

  //currently not working
  // createNewRecipe() {
  //   $("#add-new-recipe-form-id").on("submit", (event) => {
  //     event.preventDefault();
  //     var recipeStepData = [];
  //     var recipeStepID = [];
  //     var mealID = $(".meal-id").val();
  //     var data = $("#add-new-recipe-form-id").serialize();
  //     //console.log(data);

  //     // $(".recipe-step").each(function (index) {
  //     //   var recipeStep = $(this).val();
  //     //   // $(".recipe-step-id").each(function () {
  //     //   // var recipeStepId = $(this).val();
  //     //   var recipeStepId = $(".recipe-step-id").eq(index).val();

  //     //   recipeStepData.push({
  //     //     recipeStepDesc: recipeStep,
  //     //     recipeStepId: recipeStepId,
  //     //   });
  //     //   //});
  //     // });

  //     //test 1
  //     // var formData = $(".ajax-form").serializeArray()
  //     // .forEach(function (item) {
  //     //   formData[item.name] = item.value;
  //     // });

  //     //test 2
  //     var formData = {};
  //     $(".ajax-form :input").each(function () {
  //       var name = $(this).attr("name");
  //       var value = $(this).val();
  //       if (name) {
  //         var fieldName = name
  //           .replace("recipes_add_form[", "")
  //           .replace("]", "");
  //         formData[fieldName] = value;
  //       }
  //     });

  //     // var jsonData = {
  //     //   recipes_add_form: formData,
  //     // };

  //     //formData["recipes_add_form[mealID]"] = mealID;
  //     console.log(formData);
  //     var jsonRecipeData = JSON.stringify(formData);
  //     //console.log(jsonRecipeData);

  //     this.MealPlanWriter.createNewRecipe(jsonRecipeData, mealID)
  //       .then((data) => {
  //         console.log("success");
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  //   });
  // }

  closeModal() {
    $("#close-recipe-modal").on("click", function (event) {
      $(".modal").modal("hide");
    });
  }
}

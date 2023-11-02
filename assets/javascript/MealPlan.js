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
    $(document).on("keydown", ".search-text-box", (event) => {
      if (event.key === "Enter") {
        var mealName = $(event.target).val();
        this.MealPlanReader.searchByName(mealName)
          .then((data) => {
            $(".main-container").html(data);
          })
          .catch((error) => {
            console.error("Error: ", error);
          });
      }
    });
  }

  refreshMealsPage() {
    $(document).on("click", ".refresh-arrow", (event) => {
      $(".meals-container").html.empty;
      this.MealPlanReader.refreshMealsPage()
        .then((data) => {
          console.log("ping");
          console.log("data");
        })
        .catch((error) => {
          console.log(error);
        });
    });
  }

  showRecipe(mealID) {
    this.MealPlanReader.showRecipe(mealID)
      //.then((response) => response.json())
      .then((data) => {
        $(".recipe-container").append(data);
        $(".modal").modal("show");
        $(".recipe-container").css("display", "block");
      })
      .catch((error) => {
        console.log(error);
      });
    $(".recipe-container").empty();
    $(".modal").modal("hide");
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

  closeModal() {
    $("#close-recipe-modal").on("click", function (event) {
      $(".modal").modal("hide");
    });
  }
}

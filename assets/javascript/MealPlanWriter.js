export class MealPlanWriter {
  addNewRecipeToMeal(mealID, recipeStep) {
    $.ajax({
      url: "/meal/" + mealID + "/add-new-recipe",
      cache: false,
      type: "GET",
      data: { mealID: mealID, recipeStep: recipeStep },
      success: function (data) {
        resolve(data);
      },
      error: function (xhr, status, error) {
        reject(xhr);
      },
    });
  }
}

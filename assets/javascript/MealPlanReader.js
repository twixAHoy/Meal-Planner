export class MealPlanReader {
  searchByType(mealType) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "/all-meals/type/" + mealType,
        cache: false,
        type: "GET",
        //contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { mealType: mealType },
        success: function (data) {
          //console.log(data);
          resolve(data);
          //$(".main-container").html(response);
        },
        error: function (xhr, status, error) {
          console.log(error, xhr);
          reject(xhr);
        },
      });
    });
  }

  searchByName(mealName) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "/all-meals/name/" + mealName,
        cache: false,
        type: "GET",
        data: { mealName: mealName },
        success: function (data) {
          resolve(data);
        },
        error: function (xhr, status, error) {
          console.log(error, xhr);
        },
      });
    });
  }

  async showRecipe(mealID) {
    const recipe = await $.ajax({
      url: "/recipe/meal/" + mealID,
      cache: false,
      type: "GET",
      data: { id: mealID },
      success: function (recipe) {
        return recipe;
      },
      error: function (xhr, status, error) {
        return error;
      },
    });

    return recipe;
  }
}

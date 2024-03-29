/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./styles/basic.scss";
import "./styles/shoppinglist.scss";
import "./styles/forms.scss";

//import javascript
import "./javascript/index.js";
import { MealPlan } from "./javascript/MealPlan";
//import "./javascript/MealPlan";
import "./javascript/MealPlanReader";
import "./javascript/MealPlanWriter";

const mealPlan = new MealPlan();
mealPlan.initialize();

//import images
import "./images/thinker.png";

// start the Stimulus application
import "./bootstrap";

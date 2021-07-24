export * from "./enums.js";
export * from "./modifiers/index.js"; // eslint-disable-next-line import/no-unused-modules

export { popperGenerator, detectOverflow, createPopper as createPopperBase } from "./createPopper.js"; // eslint-disable-next-line import/no-unused-modules

export { createPopper } from "./popper.js"; // eslint-disable-next-line import/no-unused-modules

export { createPopper as createPopperLite } from "./popper-lite.js";cements.reduce(function (acc, placement) {
  return acc.concat([placement + "-" + start, placement + "-" + end]);
}, []);
export var placements = /*#__PURE__*/[].concat(basePlacements, [auto]).reduce(function (acc, placement) {
  return acc.concat([placement, placement + "-" + start, placement + "-" + end]);
}, []); // modifiers that need to read the DOM

export var beforeRead = 'beforeRead';
export var read = 'read';
export var afterRead = 'afterRead'; // pure-logic modifiers

export var beforeMain = 'beforeMain';
export var main = 'main';
export var afterMain = 'afterMain'; // modifier with the purpose to write to the DOM (or write into a framework state)

export var beforeWrite = 'beforeWrite';
export var write = 'write';
export var afterWrite = 'afterWrite';
export var modifierPhases = [beforeRead, read, afterRead, beforeMain, main, afterMain, beforeWrite, write, afterWrite];
import typescript from "@rollup/plugin-typescript";
import scss from "rollup-plugin-scss";

export default [
  {
    input: "src/nav/main.ts",
    output: {
      file: "lib/assets/navbar/index.js",
      format: "cjs",
    },
    plugins: [typescript({ module: "es6" }), scss()],
  },
];

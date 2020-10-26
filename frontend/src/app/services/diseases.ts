import { Timestamps } from "./timestamps";

export interface Diseases extends Timestamps {
  id?: number;
  code?: string;
  name?: string;
  solution?: string;
}
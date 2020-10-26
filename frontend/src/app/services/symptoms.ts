import { Timestamps } from "./timestamps";

export interface Symptoms extends Timestamps {
  id?: number;
  code?: string;
  name?: string;
}
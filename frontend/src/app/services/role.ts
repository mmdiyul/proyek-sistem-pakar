import { Timestamps } from "./timestamps";

export interface Role extends Timestamps {
  id?: number;
  code?: string;
  name?: string;
  priority?: number;
}
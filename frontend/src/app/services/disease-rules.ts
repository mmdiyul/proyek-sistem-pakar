import { Timestamps } from "./timestamps";
import { Diseases } from "./diseases";
import { Symptoms } from "./symptoms";

export interface DiseaseRules extends Timestamps {
  id?: number;
  code?: string;
  disease_id?: string;
  disease?: Diseases;
  symptoms?: Symptoms[];
}
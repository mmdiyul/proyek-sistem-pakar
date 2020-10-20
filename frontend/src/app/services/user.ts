import { Role } from "./role";
import { Timestamps } from "./timestamps";

export interface User extends Timestamps {
  id?: number;
  role_id?: number;
  role?: Role;
  fullname?: string;
  email?: string;
  last_logged_in?: Date;
}
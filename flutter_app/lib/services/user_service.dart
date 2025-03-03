import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class UserService {
  final String apiUrl = "http://localhost:8080/users";

  Future<List> getUsers() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? token = prefs.getString('token');

    final response = await http.get(Uri.parse(apiUrl), headers: {"Authorization": "Bearer $token"});

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    }
    return [];
  }
}

import 'package:flutter/material.dart';
import '../services/user_service.dart';

class UsersListScreen extends StatefulWidget {
  @override
  _UsersListScreenState createState() => _UsersListScreenState();
}

class _UsersListScreenState extends State<UsersListScreen> {
  final UserService userService = UserService();
  List users = [];

  @override
  void initState() {
    super.initState();
    fetchUsers();
  }

  void fetchUsers() async {
    List fetchedUsers = await userService.getUsers();
    setState(() {
      users = fetchedUsers;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Usuários")),
      body: ListView.builder(
        itemCount: users.length,
        itemBuilder: (context, index) {
          return ListTile(title: Text(users[index]['username']));
        },
      ),
    );
  }
}
